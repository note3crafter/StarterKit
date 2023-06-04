<?php

namespace TheNote\StarterKit;

use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{

    public function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $ainv = $player->getArmorInventory();
        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, []);
        if (!$player->hasPlayedBefore()) {
            if ($cfg->get("Inventory") === true) {
                foreach ($cfg->get("Slots", []) as $slot) {
                    $item = StringToItemParser::getInstance()->parse($slot["item"]);
                    $item->setCount($slot["count"]);
                    $item->setCustomName($slot["name"]);
                    $item->setLore([$slot["lore"]]);
                    $player->getInventory()->addItem($item);
                }
            }
            if ($cfg->get("Armor") === true) {
                $data = $cfg->get("helm");
                $item = StringToItemParser::getInstance()->parse($data["item"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setHelmet($item);

                $data = $cfg->get("chest");
                $item = StringToItemParser::getInstance()->parse($data["item"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setChestplate($item);

                $data = $cfg->get("leggins");
                $item = StringToItemParser::getInstance()->parse($data["item"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setLeggings($item);

                $data = $cfg->get("boots");
                $item = StringToItemParser::getInstance()->parse($data["item"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setBoots($item);
            }
        }
    }
}