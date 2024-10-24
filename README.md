# Validator - Providing Data Analysis Across Your Project
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=noxkiwi_validator&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=noxkiwi_validator)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=noxkiwi_validator&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=noxkiwi_validator)
[![Lines of Code](https://sonarcloud.io/api/project_badges/measure?project=noxkiwi_validator&metric=ncloc)](https://sonarcloud.io/summary/new_code?id=noxkiwi_validator)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=noxkiwi_validator&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=noxkiwi_validator)

## It Began With a Mistake

In 2016, during the hectic initial phase of our startup, we made a critical mistake that impacted several months of invoice provisions for our sales managers. We mistakenly applied the netToGross tax calculation for sales tax multiple times, even on already gross values, leading to significant errors. This issue went unnoticed for several months, causing considerable trouble. As a result, we developed two separate libraries to ensure valid values across all our platforms.

The first commitment was to ensure valid parameters across the entire projects by creating the Value library. Then, as a logical conclusion, the next step was to implement a standard on how data has to be validated.

```php
// The scenario is real, but this example is much simplified, of course.
function createUser(array $request): void {
    // validate field by field...
}
```

# Validator 💘 Value
### Validator
- Checks input for integrity.
- Returns one or more detailed pieces of information on why an input is problematic.

### Value
- Can only be constructed with valid input.
- Once constructed, the input is immutable, ensuring integrity during runtime.

## Just an Example
When validating data for integrity, you won't just need the fact that the input is problematic, you need a very detailed information on why the value actually is problematic. So we introduced the validator structure to almost every method that handles user input. We can't just validate numbers. There already is a collection of Validators.
Example Validators:

    IbanValidator
    EmailValidator
    DomainValidator
    ConnectionValidator
    And many more...


Here’s how you can use these Value objects:
If you are going to use the Validator stack for user inputs, you can easily do things like these:

```php
<?php declare(strict_types = 1);

namespace noxkiwi\validator;

use noxkiwi\validator\Interfaces\ValidatorInterface;

class MyController
{
    public function checkEmail(string $mailAddress): UserObject {
        $errors = EmailValidator::getInstance()->validate($mailAddress);
        if ($errors) {
            $this->response->send(Http::400, ErrorMessageBuilder::build($errors);
            return;
        }

        return UserTable::findUserForMail($mailAddress);
    }
}

class UserTable {
    public static function findUserForMail(string $mailAddress): UserObject
    {
// PSEUDO
    }
}
```

### Deeper Dive

On the other hand, you can also rely on our Value objects that integrate the Validator stack.
This way, you can ensure that the method ``findUserForMail`` will be called with a valid input which needs no further validation.


```php
class MyController
{
    public function checkEmail(string $mailAddress): UserObject {
        try {
           $mail = new EmailValue($mail);
           return UserTable::findUserForMail($mail);
        } catch (\Exception $e) {
            $this->response->send(Http::400, ErrorMessageBuilder::build($e));
        }
    }
}

class UserTable {
    public static function findUserForMail(EmailValue $mail): UserObject
    {
//PSEUDO
    }
}
```



## Interface Methods

### `validate`

```php
public function validate(mixed $value, ?array $options = null): array;
```

- **Description:** Validates the given value and returns an array of errors. If the value is valid, the array will be empty. Optional validation options can be provided.
- **Parameters:**
  - `mixed $value`: The value to be validated.
  - `array|null $options`: (Optional) An array of options for validation.
- **Returns:** `array` - An array of errors.

### `isValid`

```php
public function isValid(mixed $value): bool;
```

- **Description:** Sends the value to the validate function and returns true if the array of errors is empty.
- **Parameters:**
  - `mixed $value`: The value to be validated.
- **Returns:** `bool` - True if the value is valid, false otherwise.

### `getErrors`

```php
public function getErrors(): array;
```

- **Description:** Returns all the errors that exist in the instance.
- **Parameters:** None.
- **Returns:** `array` - An array of errors.

### `reset`

```php
public function reset(): Validator;
```

- **Description:** Removes any error from the Errorstack instance.
- **Parameters:** None.
- **Returns:** `\noxkiwi\validator\Validator` - The Validator instance.



## Let's Connect!
If you're excited about the possibility of working together or simply want to discuss innovative ideas, I'd love to hear from you.
Don't hesitate to reach out via [email](mailto:jan.nox@pm.me).

Let's create something ***amazing*** together!
