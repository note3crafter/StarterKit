<?php

namespace TheNote\StarterKit;

use pocketmine\item\ItemFactory;
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
        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->items = (array)$cfg->get("Slots");
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $ainv = $player->getArmorInventory();

        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        if (!$player->hasPlayedBefore()) {
            if ($this->cfg->get("Inventory" === true)) {
                foreach ($this->items as $item) {
                    $player->getInventory()->setItem($item["slot"], ItemFactory::get($item["slot"]["Slot1"]["id"], $item["slot"]["Slot1"]["damage"], $item["slot"]["Slot1"]["count"])->setCustomName($item["slot"]["Slot1"][$this->cfg->getNestet("name")]), $item["slot"]->setLore(["Slot1"][$this->cfg->getNestet("lore")]));
                }
            }
            if ($this->items->get("Amor" === true)) {
                $ainv->setHelmet(Item::get($this->items["helm"]["id"])->setCustomName($this->items["helm"][$this->cfg->getNestet("name")])->setLore($this->items["helm"][$this->cfg->getNestet("lore")]));
                $ainv->setChestplate(Item::get($this->items["chest"]["id"])->setCustomName($this->items["chest"][$this->cfg->getNestet("name")])->setLore($this->items["chest"][$this->cfg->getNestet("lore")]));
                $ainv->setLeggings(Item::get($this->items["leggins"]["id"])->setCustomName($this->items["leggins"][$this->cfg->getNestet("name")])->setLore($this->items["leggins"][$this->cfg->getNestet("lore")]));
                $ainv->setBoots(Item::get($this->items["boots"]["id"])->setCustomName($this->items["boots"][$this->cfg->getNestet("name")])->setLore($this->items["boots"][$this->cfg->getNestet("lore")]));
            }
        }
    }
}
