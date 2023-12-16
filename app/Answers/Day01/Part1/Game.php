<?php

namespace Mentosmenno2\AdventOfCode2023\Answers\Day01\Part1;

use Mentosmenno2\AdventOfCode2023\Lib\AbstractGame;

final class Game extends AbstractGame
{

	/**
	 * @var array<array<string>>
	 */
	protected $lines = array();

	protected function prepare_data(string $file_data): void
	{
		// Convert the text to an array of text lines.
		$lines = explode(PHP_EOL, $file_data);

		// For text line in the array of text lines, convert it to an array of characters.
		$this->lines = array_map('str_split', $lines);
	}

	protected function start(): void
	{
		// Create a variable called total, that keeps track of the sum of the numbers on every line.
		$total = 0;

		// Loop over all text lines.
		foreach ($this->lines as $index => $line) {
			// Extract only the numbers from the text.
			$digits = array_filter($line, function (string $character) {
				return is_numeric($character);
			});

			// Get the first and last number. If there is no last number, use the first number as the last number.
			$first = array_shift($digits);
			$last = array_pop($digits);
			$last = $last ?: $first;

			// Combine the two numbers into one number.
			$line_digits = (int) ( $first . $last );

			// Add the number of this line to the total variable.
			$total += $line_digits;
		}

		// Display the answer.
		$this->output->echo_line(
			sprintf('The total of all the numbers is %d.', $total)
		);
	}
}
