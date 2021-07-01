# worawitj-idcard-validate
Thai-idcard-validate

# <a id="introduction"></a> 🔒 Thai ID Card Laravel Validation

แพคเกจนี้พัฒนามาจาก phattarachai/thai-id-card-validation เพื่อใช้ในการทำ Project ต่อยอด
Validation Rule สำหรับตรวจสอบความถูกต้องรหัสบัตรประชาชน สามารถใช้ได้ทั้งในใน Laravel และ PHP Project.

# <a id="installation"></a> ติดตั้ง

```
composer require worawitj/validation
```

# <a id="usage"></a> การใช้งาน

เรียกใช้ class ThaiIdCardRule ใน field ที่ต้องการ validate

```php
use Worawitj\Validation\ThaiIdCardRule;

// ใน controller
$this->validate($request, [
    'email' => 'required',
    'id_card_no' => new ThaiIdCardRule,
    // ... 
]);

```


# <a id="usage"></a> Validation Message

ถ้า validate ไม่ผ่านจะแสดงข้อความ `Please Check Your IdCard` เป็นค่าเริ่มต้ม ถ้าต้องการแก้ไข message สามารถ override
class เพื่อแก้ message ได้


$validator = Validator::make($request_data, ['id_card' => 'required|string|new ThaiIdCardRule('IdCard is not Valid',$request)']);


```php
use Worawitj\Validation\ThaiIdCardRule as Rule;


class NewThaiIdCardRule extends Rule
{
    /**
     * Get the validation error message.
     *
     * @return string
     */
     public function message()
    {

        return $this->message?:"Please Check Your IdCard";
    }
}

```

# การใช้งานใน PHP (นอก Laravel Project)

ถ้าต้องการตรวจสอบรหัสบัตรประชาชนใน PHP หรือ Framework อื่น ๆ ที่ไม่ใช่ Laravel สามารถทำได้ผ่าน class ThaiIdCard

```php
use WorawitjIdcardValidate\ThaiIdCardValidation\NewThaiIdCardRule;

$result = (new NewThaiIdCard)->validate('1085217077105');
// true

$result = (new NewThaiIdCard)->validate('1234567890123');
// false

```

## License

The MIT License (MIT)
