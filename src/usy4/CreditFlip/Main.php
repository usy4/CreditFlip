<?php

namespace usy4\CreaditFlip;

use pocketmine\plugin\PluginBase;

use usy4/CreditFlip/Commands/CreditFlipCommand;

class Main extends PluginBase {
    
    public function onEnable() : void{
        $this->getServer()->getCommandMap()->register($this->getName(), new SuggestionsCommand($this)); 
    }
   
    public function TrailsOrHeads{
        return mt_rand(0,1);
    } // 0=trails, 1=heads.
 
}
