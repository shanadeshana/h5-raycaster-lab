<?php

class LabyRoomWatch extends LabyRoomHelper {

  protected $oRoom;

  public function getBlockData() { return array(); }
  public function setWallThing($c, $n, $nOffset = 0, $nInsideOffset = 0) {
    $w2 = $this->oRoom->getWidth() - 2;
    $h2 = $this->oRoom->getHeight() - 2;
    switch ($c % 4) {
      case 0:
        $this->oRoom->setCell(3 + $nOffset, 1 + $nInsideOffset, $n);
      break;

      case 1:
        $this->oRoom->setCell($w2 - $nInsideOffset, 3 + $nOffset, $n);
      break;

      case 2:
        $this->oRoom->setCell($this->oRoom->getWidth() - 1 - 3 + $nOffset, $h2 - $nInsideOffset, $n);
      break;

      case 3:
        $this->oRoom->setCell(1 + $nInsideOffset, $this->oRoom->getHeight() - 1 - 3 + $nOffset, $n);
      break;
    }    
  }

  public function generate($oRoom) {
    $this->oRoom = $oRoom;
    $w2 = $this->oRoom->getWidth() - 2;
    $w4 = $this->oRoom->getWidth() - 4;
    $h2 = $this->oRoom->getHeight() - 2;
    $h4 = $this->oRoom->getHeight() - 4;
    $this->oRoom->generateCentralPillar(BLOCK_WALL, $w2, $h2);
    $this->oRoom->generateCentralPillar(BLOCK_VOID, $w4, $h4);
    $c = $this->oRnd->getRandom(0, 3);
    $this->setWallThing($c, BLOCK_DOOR);
    $this->setWallThing($c + 1, BLOCK_WINDOW);
    $nTreasureCount = $this->oRnd->getRandom(0, 1);
    switch ($nTreasureCount) {
      case 0:
        $this->setWallThing($c + 2, BLOCK_TREASURE, 0, 1);
        $this->setWallThing($c + 2, BLOCK_WALL, 1, 1);
        $this->setWallThing($c + 2, BLOCK_WALL, -1, 1);
      break;

      case 1:
        $this->setWallThing($c + 2, BLOCK_WALL, 0, 1);
        $this->setWallThing($c + 2, BLOCK_TREASURE, 1, 1);
        $this->setWallThing($c + 2, BLOCK_TREASURE, -1, 1);
        $this->setWallThing($c + 2, BLOCK_WALL, -2, 1);
        $this->setWallThing($c + 2, BLOCK_WALL, 2, 1);
      break;
    }
    $this->setWallThing($c + 3, BLOCK_WINDOW);
  }
}

