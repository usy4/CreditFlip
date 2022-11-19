<?php

namespace usy4\CreaditFlip;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;

use usy4/CreditFlip/commands/CreditFlipCommand;

class Main extends PluginBase {
    
    public $credits;
  
    public function onEnable(): void{

       $this->credits = $this->getServer()->getPluginManager()->getPlugin("Credits");
       $this->getServer()->getCommandMap()->register($this->getName(), new SuggestionsCommand($this)); 
    }
   
    public function TrailsOrHeads{
        return mt_rand(0,1);
    } // 0=trails, 1=heads.

    public function getCredits(Player $player){
        return $this->credits->reducedCredits($player);
    }

     public function addCredits(Player $player, int $amount){
        return $this->credits->reducedCredits($player, $amount);
    }

     public function reduceCredits(Player $player, $amount){
        return $this->credits->reduceCredits($player, $amount);
    }
 
}
