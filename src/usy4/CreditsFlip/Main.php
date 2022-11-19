<?php

namespace usy4\CreditsFlip;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;

use usy4\CreditsFlip\commands\CreditFlipCommand;

class Main extends PluginBase {
    
    public $credits;
  
    public function onEnable(): void{

       $this->credits = $this->getServer()->getPluginManager()->getPlugin("Credits");
       $this->getServer()->getCommandMap()->register($this->getName(), new CreditFlipCommand($this)); 
    }
   
    public function TailsOrHeads(){
        return mt_rand(0,1);
    } // 0=tails, 1=heads.

    public function getCredits(Player $player){
        return $this->credits->getCredits($player);
    }

     public function addCredits(Player $player, int $amount){
        return $this->credits->addCredits($player, $amount);
    }

     public function reduceCredits(Player $player, $amount){
        return $this->credits->reduceCredits($player, $amount);
    }
 
}
