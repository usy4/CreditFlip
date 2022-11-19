<?php 

namespace usy4\CreditFlip\commands;

/*  
 *  A plugin for PocketMine-MP.
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 	
 */

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\Plugin;
use pocketmine\player\Player;

use usy4\CreditFlip\Main;

class CreditFlipCommand extends Command implements PluginOwned
{
	public function __construct(
		public Main $plugin
	) {
		parent::__construct("creditflip", "don't be scared, try your luck", null, ["creditsflip", "cf"]);
	}
	
	public function execute(CommandSender $sender, string $commandLabel, array $args) {
		if(!$sender instanceof Player) {
			$sender->sendMessage("use this command in game");
			return;
		}
		
		if(count($args) < 2) return $sender->sendMessage("Usage: /creditflip (tails/heads) amount");

                if(!is_numeric($args[2])) return $sender->sendMessage("The amount must to be a number.");

                if($args[2] > $this->plugin->getCredits($sender)) return $sender->sendMessage("Sorry, but you don't have that much credit");

                switch(strtolower($args[1])){
                 case "tails":
                  if($this->plugin->TailsOrHeads() !== 0){
                   $this->plugin->reduceCredits($sender, intval($args[2]));
                   $sender->sendMessage("It's 'heads', You lost §c-".$args[2]."\n§rNow, you have ".$this->plugin->getCredits($sender));
                   return;
                  }
                   $this->plugin->addCredits($sender, intval($args[2]));
                   $sender->sendMessage("It's 'tails', You won §a+".$args[2]."\n§rNow, you have ".$this->plugin->getCredits($sender));
                  break;

                 case "heads":
                  if($this->plugin->TailsOrHeads() !== 1){
                   $this->plugin->reduceCredits($sender, intval($args[2]));
                   $sender->sendMessage("It's 'tails', You lost §c-".$args[2]."\n§rNow, you have ".$this->plugin->getCredits($sender));
                   return;
                  }
                   $this->plugin->addCredits($sender, intval($args[2]));
                   $sender->sendMessage("It's 'heads', You won §a+".$args[2]."\n§rNow, you have ".$this->plugin->getCredits($sender));
                  break;
                default:
                  $sender->sendMessage("Usage: /creditflip (tails/heads) amount");
                 break;
                }
	}
	
	public function getOwningPlugin(): Plugin{
		return $this->plugin;
	}
}
