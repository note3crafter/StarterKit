<?php

namespace TheNote\StarterKit;

use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{

    private $items = [];

    public function onEnable()
    {
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->items = (array) $cfg->get("Slots");

    }

    /**
     * @param PlayerJoinEvent $event
     * @PRIORITY LOWEST
     */
    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();

        if(!$player->hasPlayedBefore()){
            foreach($this->items as $item){
                $player->getInventory()->setItem($item["slot"], ItemFactory::get($item["id"], $item["damage"], $item["count"]));
            }
        }
    }
}
