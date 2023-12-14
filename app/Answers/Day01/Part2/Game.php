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
		$lines = explode(PHP_EOL, $file_data);
		$this->lines = $lines;
	}

	protected function start(): void
	{
		$total = 0;
		foreach ($this->lines as $index => $line) {
			$first_digit = $this->getFirstDigit($line);
			$lastDigit = $this->getLastDigit($line);
			$totalDigit = $first_digit . $lastDigit;

			$this->output->echo_line(
				sprintf('The total of line %d is %d.', $index, $totalDigit)
			);

			$total += (int) $totalDigit;
		}

		$this->output->echo_line(
			sprintf('The total of all the numbers is %d.', $total)
		);
	}

	protected function getFirstDigit(string $line): ?string
	{
		for ($i=0; $i < strlen($line); $i++) {
			$string_part = substr($line, 0, $i + 1);
			foreach ($this->map as $key => $value) {
				if (str_ends_with($string_part, (string) $key)) {
					return $value;
				}
			}
		}
		return null;
	}

	protected function getLastDigit(string $line): ?string
	{
		for ($i=0; $i < strlen($line); $i++) {
			$string_part = substr($line, strlen($line) - 1 - $i, strlen($line));
			foreach ($this->map as $key => $value) {
				if (str_starts_with($string_part, (string) $key)) {
					return $value;
				}
			}
		}
		return null;
	}
}
