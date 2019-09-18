<?php

namespace TheNote\StarterKit;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

 public function onJoin(PlayerJoinEvent $event) {
            $player = $event->getPlayer();
            $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array());
            $i = $this->cfg->getAll();
            if(!$player->hasPlayedBefore()) {
                $player->getInventory()->setItem(1, Item::get($i["Slot1"]["id"], $i["Slot1"]["damage"], $i["Slot1"]["count"]));
                $player->getInventory()->setItem(2, Item::get($i["Slot2"]["id"], $i["Slot2"]["damage"], $i["Slot2"]["count"]));
                $player->getInventory()->setItem(3, Item::get($i["Slot3"]["id"], $i["Slot3"]["damage"], $i["Slot3"]["count"]));
                $player->getInventory()->setItem(4, Item::get($i["Slot4"]["id"], $i["Slot4"]["damage"], $i["Slot4"]["count"]));
                $player->getInventory()->setItem(5, Item::get($i["Slot5"]["id"], $i["Slot5"]["damage"], $i["Slot5"]["count"]));
                $player->getInventory()->setItem(6, Item::get($i["Slot6"]["id"], $i["Slot6"]["damage"], $i["Slot6"]["count"]));
                $player->getInventory()->setItem(7, Item::get($i["Slot7"]["id"], $i["Slot7"]["damage"], $i["Slot7"]["count"]));
                $player->getInventory()->setItem(8, Item::get($i["Slot8"]["id"], $i["Slot8"]["damage"], $i["Slot8"]["count"]));
                $player->getInventory()->setItem(9, Item::get($i["Slot9"]["id"], $i["Slot9"]["damage"], $i["Slot9"]["count"]));

            }
        }
}
