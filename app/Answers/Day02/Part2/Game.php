<?php

namespace Mentosmenno2\AdventOfCode2023\Answers\Day02\Part2;

use Mentosmenno2\AdventOfCode2023\Lib\AbstractGame;

final class Game extends AbstractGame
{

	/**
	 * @var array<int,array<array<string,int>>>
	 */
	protected $games = array();

	protected function prepare_data(string $fileData): void
	{
		// Convert the text to an array of text lines.
		$lines = explode(PHP_EOL, $fileData);

		// Loop over all the text lines.
		foreach ($lines as $line) {
			// Make two parts of the text line: The game number part and the rolls part.
			$lineParts = explode(': ', $line);

			// Get the game number, and add it as a key to my games variable.
			$gameNumber = (int) trim(str_replace('Game ', '', $lineParts[0]));
			$this->games[$gameNumber] = array();

			// Convert the rolls part of the text to an array of rolls.
			$rolls = explode('; ', $lineParts[1]);

			// Loop all role texts
			foreach ($rolls as $roll) {
				$rollData = array(
					'red' => 0,
					'green' => 0,
					'blue' => 0,
				);

				// Extract the dice from each roll. For each dice, add it's number to the rollData variable.
				$rollColorData = explode(', ', $roll);
				foreach ($rollColorData as $rollColorDataItem) {
					$rollColorDataItemParts = explode(' ', $rollColorDataItem);
					$rollData[$rollColorDataItemParts[1]] = (int) $rollColorDataItemParts[0];
				}

				// Finally, add the rollData to the game number rolls.
				$this->games[$gameNumber][] = $rollData;
			}
		}
	}

	protected function start(): void
	{
		// Create a variable called total, that keeps track of the sum of all powers.
		$total = 0;

		// Loop over all the games played.
		foreach ($this->games as $gameNumber => $rolls) {
			$minColors = array(
				'red' => 0,
				'green' => 0,
				'blue' => 0,
			);

			// Loop over all the rolls. For each color, if more is rolled than in a previous roll of this game, store the value.
			foreach ($rolls as $roll) {
				$minColors['red'] = max($minColors['red'], $roll['red']);
				$minColors['green'] = max($minColors['green'], $roll['green']);
				$minColors['blue'] = max($minColors['blue'], $roll['blue']);
			}

			// Do red * green * blue of all the highest rolls for every color
			$power = array_product(array_values($minColors));

			// Add the power to the total.
			$total += $power;
		}

		// Display the answer
		$this->output->echo_line(
			sprintf('The sum of all the numbers is %d.', $total)
		);
	}
}
