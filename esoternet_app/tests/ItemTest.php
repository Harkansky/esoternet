<?php
namespace App\Tests;

use App\Entity\Item;
use App\Entity\Pact;
use App\Entity\Ritual;
use PHPUnit\Framework\TestCase;
//TEST Unitaire pour la création d'item
class ItemTest extends TestCase
{
    public function testItemProperties()
    {
        $item = new Item();
        $item->setName("Pack Baptiste");
        $item->setDescription("Le pack démoniaque qui te permet de maitriser le symfony.");
        $item->setPrice(69.99);
        $date = new \DateTime();
        $item->setDateAdded($date);

        $this->assertSame("Pack Baptiste", $item->getName());
        $this->assertSame("Le pack démoniaque qui te permet de maitriser le symfony.", $item->getDescription());
        $this->assertSame(69.99, $item->getPrice());
        $this->assertSame($date, $item->getDateAdded());
    }
    public function testAddAndRemoveRitual()
    {
        $item = new Item();
        $ritual = new Ritual();

        $item->addRitualLink($ritual);
        $this->assertCount(1, $item->getRitualLink());

        $item->removeRitualLink($ritual);
        $this->assertCount(0, $item->getRitualLink());
    }
    public function testAddAndRemovePact()
    {
        $item = new Item();
        $pact = new Pact();

        $item->addPactLink($pact);
        $this->assertCount(1, $item->getPactLink());

        $item->removePactLink($pact);
        $this->assertCount(0, $item->getPactLink());
    }
}
