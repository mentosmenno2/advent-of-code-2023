<?php

namespace Mentosmenno2\AdventOfCode2023\Answers\Day02\Part1;

use Mentosmenno2\AdventOfCode2023\Lib\AbstractGame;

final class Game extends AbstractGame
{

	/**
	 * @var array<int,array<array<string,int>>>
	 */
	protected $games = array();

	protected function prepare_data(string $fileData): void
	{
		$lines = explode(PHP_EOL, $fileData);
		foreach ($lines as $line) {
			$lineParts = explode(': ', $line);

			// Prepare game
			$gameNumber = (int) trim(str_replace('Game ', '', $lineParts[0]));
			$this->games[$gameNumber] = array();

			// Prepare rolls of games
			$rolls = explode('; ', $lineParts[1]);
			foreach ($rolls as $roll) {
				$rollData = array(
					'red' => 0,
					'green' => 0,
					'blue' => 0,
				);

				$rollColorData = explode(', ', $roll);
				foreach ($rollColorData as $rollColorDataItem) {
					$rollColorDataItemParts = explode(' ', $rollColorDataItem);
					$rollData[$rollColorDataItemParts[1]] = (int) $rollColorDataItemParts[0];
				}

				$this->games[$gameNumber][] = $rollData;
			}
		}
	}

	protected function start(): void
	{
		$total = 0;
		foreach ($this->games as $gameNumber => $rolls) {
			$valid = true;
			foreach ($rolls as $roll) {
				if ($roll['red'] > 12 || $roll['green'] > 13 || $roll['blue'] > 14) {
					$valid = false;
					break;
				}
			}

			if ($valid) {
				$total += $gameNumber;
			}
		}

		$this->output->echo_line(
			sprintf('The sum of all the numbers is %d.', $total)
		);
	}
}
