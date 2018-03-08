<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
 */

namespace pocketmine\entity\behavior\navigator\algorithms;

use pocketmine\block\Block;
use pocketmine\entity\behavior\navigator\Tile;

class BlockDistanceAlgorithm implements DistanceAlgorithm{

    /** @var Block[] */
    private $blockCache;
    /** @var bool */
    private $canClimb;

    public function __construct(\stdClass $cache, bool $canClimb = false){
        $this->blockCache = $cache;
        $this->canClimb = $canClimb;
    }

    public function calculate(Tile $from, Tile $to) : float{
        $vFrom = $this->getBlock($from);
        $vTo = $this->getBlock($to);

        if($this->canClimb){
            $vFrom->y = 0;
            $vTo->y = 0;
        }

        return $vFrom->distance($vTo);
    }

    public function getBlock(Tile $tile) : ?Block{
        return $this->blockCache->{$tile->getHashCode()} ?? null;
    }
}