<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloIndo;
use App\Services\HelloServiceIndo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo = $this->app->make(Foo::class); //new Foo()
        $fool = $this->app->make(Foo::class); //new Foo()

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo', $fool->foo());
        // self::assertNotSame($foo, $fool);
        self::assertSame($foo,$fool);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("Eko", "Khannedy");
        });

        $person1 = $this->app->make(Person::class); // closure() // new Person("Eko", "Khannedy");
        $person2 = $this->app->make(Person::class); // closure() // new Person("Eko", "Khannedy");

        self::assertEquals('Eko', $person1->firstName);
        self::assertEquals('Eko', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Eko", "Khannedy");
        });

        $person1 = $this->app->make(Person::class); // new Person("Eko", "Khannedy"); if not exists
        $person2 = $this->app->make(Person::class); // return existing
        $person3 = $this->app->make(Person::class); // return existing
        $person4 = $this->app->make(Person::class); // return existing

        self::assertEquals('Eko', $person1->firstName);
        self::assertEquals('Eko', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testInstance()
    {
        $person = new Person("Eko", "Khannedy");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertEquals('Eko', $person1->firstName);
        self::assertEquals('Eko', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testDependencyInjection()
    {

        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);

        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloIndo::class);

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndo();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Eko', $helloService->hello('Eko'));
    }
}
