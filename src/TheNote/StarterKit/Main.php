<?php

namespace TheNote\StarterKit;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public function onEnable()
    {
          $this->saveDefaultConfig();
          $this->getLogger()->info("StarterKit by TheNote enabled!");
                  $this->getServer()->getPluginManager()->registerEvents($this ,$this);
        }
    
public function onJoin(PlayerJoinEvent $event) {
            $player = $event->getPlayer();
            $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array());
            $i = $this->cfg->getAll();
            if(!$player->hasPlayedBefore()) {
                $player->getInventory()->setItem(0, Item::get($i["Item0"]["id"], $i["Item0"]["damage"], $i["Item0"]["count"]));
                $player->getInventory()->setItem(1, Item::get($i["Item1"]["id"], $i["Item1"]["damage"], $i["Item1"]["count"]));
                $player->getInventory()->setItem(2, Item::get($i["Item2"]["id"], $i["Item2"]["damage"], $i["Item2"]["count"]));
                $player->getInventory()->setItem(3, Item::get($i["Item3"]["id"], $i["Item3"]["damage"], $i["Item3"]["count"]));
                $player->getInventory()->setItem(4, Item::get($i["Item4"]["id"], $i["Item4"]["damage"], $i["Item4"]["count"]));
                $player->getInventory()->setItem(5, Item::get($i["Item5"]["id"], $i["Item5"]["damage"], $i["Item5"]["count"]));
            }
        }
}
