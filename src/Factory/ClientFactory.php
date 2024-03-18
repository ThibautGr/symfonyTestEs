<?php

namespace App\Factory;

use App\Entity\Client;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Client>
 *
 * @method        Client|Proxy     create(array|callable $attributes = [])
 * @method static Client|Proxy     createOne(array $attributes = [])
 * @method static Client[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Client[]|Proxy[] createSequence(iterable|callable $sequence)
 */
final class ClientFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'nom' => self::faker()->name(),
            'email' => self::faker()->email(),
            'adresse' => self::faker()->address(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
//            ->withoutPersisting()
            // ->afterInstantiate(function(Client $client): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Client::class;
    }
}
