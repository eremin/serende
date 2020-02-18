# SerEnDe
> PHP serialize() encoder & decoder

## Contents
- [Install](#install)
- [Use](#use)
  - [Decoder](#decoder)
  - [Encoder](#encoder)
  - [Types](#types)

## Install

I.e. with composer:
```bash
composer req eremin/serende
```

## Use

Instances of decoder or encoder could be created with the factory class
```php
use Eremin\SerEnDe\Factory;
$decoder = Factory::createDecoder();
$encoder = Factory::createEncoder();
```

### Decoder

Call `decodeFromString()` method, if you have serialized data in string 
or `decodeFromStream()` method, if you have it in some PHP stream.
```php
$test = [
    1 => 'a',
    'b' => 2,
    true,
    'refTarget' => 'REF_TARGET',
];
$test['ref'] = &$test['refTarget'];
$serialized = \serialize($test);
/// string(86) "a:5:{i:1;s:1:"a";s:1:"b";i:2;i:2;b:1;s:9:"refTarget";s:10:"REF_TARGET";s:3:"ref";R:5;}"
$parsed = $decoder->decodeFromString($serialized);
// object(Eremin\SerEnDe\Types\ArrayType)#25 (2) {
//   ["elements":"Eremin\SerEnDe\Types\ArrayType":private]=>
//   array(5) {
//     [0]=>
//     object(Eremin\SerEnDe\Types\ArrayType\Element)#28 (2) {
//       ["key":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\IntType)#26 (1) {
//         ["rawContent"]=>
//         string(1) "1"
//       }
//       ["value":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\StringType)#27 (1) {
//         ["rawContent"]=>
//         string(1) "a"
//       }
//     }
//     [1]=>
//     object(Eremin\SerEnDe\Types\ArrayType\Element)#31 (2) {
//       ["key":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\StringType)#29 (1) {
//         ["rawContent"]=>
//         string(1) "b"
//       }
//       ["value":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\IntType)#30 (1) {
//         ["rawContent"]=>
//         string(1) "2"
//       }
//     }
//     [2]=>
//     object(Eremin\SerEnDe\Types\ArrayType\Element)#34 (2) {
//       ["key":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\IntType)#32 (1) {
//         ["rawContent"]=>
//         string(1) "2"
//       }
//       ["value":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\BoolType)#33 (1) {
//         ["rawContent"]=>
//         string(1) "1"
//       }
//     }
//     [3]=>
//     object(Eremin\SerEnDe\Types\ArrayType\Element)#37 (2) {
//       ["key":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\StringType)#35 (1) {
//         ["rawContent"]=>
//         string(9) "refTarget"
//       }
//       ["value":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\StringType)#36 (1) {
//         ["rawContent"]=>
//         string(10) "REF_TARGET"
//       }
//     }
//     [4]=>
//     object(Eremin\SerEnDe\Types\ArrayType\Element)#40 (2) {
//       ["key":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\StringType)#38 (1) {
//         ["rawContent"]=>
//         string(3) "ref"
//       }
//       ["value":"Eremin\SerEnDe\Types\ArrayType\Element":private]=>
//       object(Eremin\SerEnDe\Types\ReferenceType)#39 (2) {
//         ["referencedType":"Eremin\SerEnDe\Types\ReferenceType":private]=>
//         object(Eremin\SerEnDe\Types\StringType)#36 (1) {
//           ["rawContent"]=>
//           string(10) "REF_TARGET"
//         }
//         ["rawContent"]=>
//         string(1) "5"
//       }
//     }
//   }
//   ["rawContent"]=>
//   NULL
// } 
```

### Encoder

The encoder has only one method `encode()`:
```php
$serialized = $encoder->encode($parsed);
// a:5:{i:1;s:1:"a";s:1:"b";i:2;i:2;b:1;s:9:"refTarget";s:10:"REF_TARGET";s:3:"ref";R:5;}
$data = unserialize($serialized);
// array(5) {
//   [1]=>
//   string(1) "a"
//   ["b"]=>
//   int(2)
//   [2]=>
//   bool(true)
//   ["refTarget"]=>
//   &string(10) "REF_TARGET"
//   ["ref"]=>
//   &string(10) "REF_TARGET"
// }
```

### Types

All types have the property `$rawContent`,
but this should be used directly only at `StringType` and `SerializableObjectType`

#### NullType

It represents NULL and has no content and no methods.
```php
$type = new \Eremin\SerEnDe\Types\NullType();
$encoder->encode($type);
// N;
```

#### BoolType

It represents boolean and has two methods.
```php
$type = new \Eremin\SerEnDe\Types\BoolType();
$type->setValue(true);
$encoder->encode($type);
// b:1;
$type->getValue();
// bool(true)
```

#### IntType

It represents integer and has two methods.
```php
$type = new \Eremin\SerEnDe\Types\IntType();
$type->setValue(-555);
$encoder->encode($type);
// i:-555;
$type->getValue();
// int(-555)
```

#### FloatType

It represents float and has two methods.
```php
$type = new \Eremin\SerEnDe\Types\FloatType();
$type->setValue(-5e-5);
$encoder->encode($type);
// d:-5.0E-5;;
$type->getValue();
// float(-5.0E-5)
```

#### StringType

It represents string and as said above content of string will be accessed via `$rawContent` property.
```php
$type = new \Eremin\SerEnDe\Types\StringType();
$type->setValue("hello \"\\ world!");
$encoder->encode($type);
// s:15:"hello "\ world!";
$type->getValue();
// string(15) "hello "\ world!"
```

#### SerializableObjectType

It represents object that implement `\Serializable` interface
([PHP documentation](https://www.php.net/manual/en/class.serializable.php)).
It content will be produced via methods of this interface
and can be accessed via `$rawContent` property.
```php
class A implements Serializable {
    public $foo;
    public function serialize()
    {
        return \json_encode($this);
    }

    public function unserialize($serialized)
    {
        return \json_decode($serialized, true);
    }
}
class B {}
$type = new \Eremin\SerEnDe\Types\SerializableObjectType();
$type->setValue(\json_encode(['foo' => 'bar']));
$encoder->encode($type);
// C:1:"A":13:{{"foo":"bar"}}
$type->getValue();
// {"foo":"bar"}
$type->className = 'B';
unserialize($encoder->encode($type));
// Warning: Class B has no unserializer
// object(B)#23 (0) {
// }
```

#### ArrayHandler

coming soon...

#### ObjectHandler

coming soon...
