<?php

namespace Mentosmenno2\AdventOfCode2023\Answers\Day01\Part1;

use Mentosmenno2\AdventOfCode2023\Lib\AbstractGame;

final class Game extends AbstractGame
{

	/**
	 * @var string[]
	 */
	protected $lines = array();

	protected function prepare_data(string $file_data): void
	{
		$lines = explode(PHP_EOL, $file_data);
		$this->lines = array_map('str_split', $lines);
	}

	protected function start(): void
	{
		$total = 0;
		foreach ($this->lines as $index => $line) {
			$digits = array_filter($line, function (string $character) {
				return is_numeric($character);
			});

			$first = array_shift($digits);
			$last = array_pop($digits);
			$last = $last ?: $first;

			$line_digits = (int) ( $first . $last );
			$total += $line_digits;

			$this->output->echo_line(
				sprintf('The total of line %d is %d.', $index + 1, $line_digits)
			);
		}

		$this->output->echo_line(
			sprintf('The total of all the numbers is %d.', $total)
		);
	}
}
