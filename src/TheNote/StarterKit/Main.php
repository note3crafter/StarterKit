<?php

namespace TheNote\StarterKit;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $ainv = $player->getArmorInventory();

        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        if (!$player->hasPlayedBefore()) {
            if ($cfg->get("Inventory", false)) {
                foreach ($cfg->get("Slots", []) as $item) {
                    $result = Item::get($item["id"], $item["damage"], $item["count"]);
                    $result->setCustomName($item["name"]);
                    $result->setLore([$item["lore"]]);
                    $player->getInventory()->setItem($item["slot"], $result);
                }
            }
            if ($cfg->get("Amor", false)) {
                $data = $cfg->get("helm");
                $item = Item::get($data["id"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setHelmet($item);

                $data = $cfg->get("chest");
                $item = Item::get($data["id"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setChestplate($item);

                $data = $cfg->get("leggins");
                $item = Item::get($data["id"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setLeggings($item);

                $data = $cfg->get("boots");
                $item = Item::get($data["id"]);
                $item->setCustomName($data["name"]);
                $item->setLore([$data["lore"]]);
                $ainv->setBoots($item);
            }
        }
    }
}
