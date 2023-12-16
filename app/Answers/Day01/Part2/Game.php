<?php

namespace Mentosmenno2\AdventOfCode2023\Answers\Day01\Part2;

use Mentosmenno2\AdventOfCode2023\Lib\AbstractGame;

final class Game extends AbstractGame
{

	/**
	 * @var string[]
	 */
	protected $lines = array();

	/**
	 * @var array<int|string,string>
	 */
	protected $map = array(
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'one' => '1',
		'two' => '2',
		'three' => '3',
		'four' => '4',
		'five' => '5',
		'six' => '6',
		'seven' => '7',
		'eight' => '8',
		'nine' => '9',
	);

	protected function prepare_data(string $file_data): void
	{
		// Convert the text to an array of text lines.
		$lines = explode(PHP_EOL, $file_data);
		$this->lines = $lines;
	}

	protected function start(): void
	{
		// Create a variable called total, that keeps track of the sum of the numbers on every line.
		$total = 0;

		// Loop over all text lines.
		foreach ($this->lines as $index => $line) {
			// Get the first and last number.
			$first_digit = $this->getFirstDigit($line);
			$lastDigit = $this->getLastDigit($line);

			// Combine the two numbers into one number.
			$totalDigit = $first_digit . $lastDigit;

			// Add the number of this line to the total variable.
			$total += (int) $totalDigit;
		}

		// Display the answer.
		$this->output->echo_line(
			sprintf('The total of all the numbers is %d.', $total)
		);
	}

	protected function getFirstDigit(string $line): ?string
	{
		// We loop for every character in the line text.
		for ($i=0; $i < strlen($line); $i++) {
			// Make a string starting from the first character of the line, with the length of the total amount of loops.
			$string_part = substr($line, 0, $i + 1);

			// Now check all the numbers or written numbers.
			foreach ($this->map as $key => $value) {
				// If the text ends with the (written) number you are currently checking, return it.
				if (str_ends_with($string_part, (string) $key)) {
					// Return the (written) number.
					return $value;
				}
			}
		}
		return null;
	}

	protected function getLastDigit(string $line): ?string
	{
		// We loop for every character in the line text.
		for ($i=0; $i < strlen($line); $i++) {
			// Make a string starting from the last character of the line, with the inverted length of the total amount of loops.
			$string_part = substr($line, strlen($line) - 1 - $i, strlen($line));

			// Now check all the numbers or written numbers.
			foreach ($this->map as $key => $value) {
				// If the text starts with the (written) number you are currently checking, return it.
				if (str_starts_with($string_part, (string) $key)) {
					// Return the (written) number.
					return $value;
				}
			}
		}
		return null;
	}
}
