<?php

declare(strict_types=1);

return [
    'accepted'             => ':Attribute باید پذیرفته شده باشد.',
    'accepted_if'          => ':Attribute باید پذیرفته شده باشد وقتی :other برابر :value است.',
    'active_url'           => 'آدرس :attribute معتبر نیست.',
    'after'                => ':Attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal'       => ':Attribute باید تاریخی بعد از :date، یا مطابق با آن باشد.',
    'alpha'                => ':Attribute باید فقط حروف الفبا باشد.',
    'alpha_dash'           => ':Attribute باید فقط حروف الفبا، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num'            => ':Attribute باید فقط حروف الفبا و اعداد باشد.',
    'array'                => ':Attribute باید آرایه باشد.',
    'ascii'                => ':Attribute تنها میتواند شامل کاراکترها و نمادهای الفبایی تک بایتی باشد.',
    'before'               => ':Attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal'      => ':Attribute باید تاریخی قبل از :date، یا مطابق با آن باشد.',
    'between'              => [
        'array'   => ':Attribute باید بین :min و :max آیتم باشد.',
        'file'    => ':Attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => ':Attribute باید بین :min و :max باشد.',
        'string'  => ':Attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean'              => 'فیلد :attribute فقط می‌تواند true و یا false باشد.',
    'confirmed'            => ':Attribute با فیلد تکرار مطابقت ندارد.',
    'current_password'     => 'رمزعبور اشتباه است.',
    'date'                 => ':Attribute یک تاریخ معتبر نیست.',
    'date_equals'          => ':Attribute باید یک تاریخ برابر با تاریخ :date باشد.',
    'date_format'          => ':Attribute با الگوی :format مطابقت ندارد.',
    'decimal'              => ':Attribute باید شامل :decimal اعشار باشد.',
    'declined'             => ':Attribute باید رد شده باشد.',
    'declined_if'          => ':Attribute باید رد شده باشد وقتی :other برابر :value است.',
    'different'            => ':Attribute و :other باید از یکدیگر متفاوت باشند.',
    'digits'               => ':Attribute باید :digits رقم باشد.',
    'digits_between'       => ':Attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => 'ابعاد تصویر :attribute قابل قبول نیست.',
    'distinct'             => 'فیلد :attribute مقدار تکراری دارد.',
    'doesnt_end_with'      => 'مقدار :attribute نباید با این مقادیر تمام شود : :values.',
    'doesnt_start_with'    => 'مقدار :attribute نباید با این مقادیر شروع شود : :values.',
    'email'                => ':Attribute باید یک ایمیل معتبر باشد.',
    'ends_with'            => 'فیلد :attribute باید با یکی از مقادیر زیر خاتمه یابد: :values',
    'enum'                 => ':Attribute انتخاب شده اشتباه است.',
    'exists'               => ':Attribute انتخاب شده، معتبر نیست.',
    'file'                 => ':Attribute باید یک فایل معتبر باشد.',
    'filled'               => 'فیلد :attribute باید مقدار داشته باشد.',
    'gt'                   => [
        'array'   => ':Attribute باید بیشتر از :value آیتم داشته باشد.',
        'file'    => ':Attribute باید بزرگتر از :value کیلوبایت باشد.',
        'numeric' => ':Attribute باید بزرگتر از :value باشد.',
        'string'  => ':Attribute باید بیشتر از :value کاراکتر داشته باشد.',
    ],
    'gte'                  => [
        'array'   => ':Attribute باید بیشتر یا مساوی :value آیتم داشته باشد.',
        'file'    => ':Attribute باید بزرگتر یا مساوی :value کیلوبایت باشد.',
        'numeric' => ':Attribute باید بزرگتر یا مساوی :value باشد.',
        'string'  => ':Attribute باید بیشتر یا مساوی :value کاراکتر داشته باشد.',
    ],
    'image'                => ':Attribute باید یک تصویر معتبر باشد.',
    'in'                   => ':Attribute انتخاب شده، معتبر نیست.',
    'in_array'             => 'فیلد :attribute در لیست :other وجود ندارد.',
    'integer'              => ':Attribute باید عدد صحیح باشد.',
    'ip'                   => ':Attribute باید آدرس IP معتبر باشد.',
    'ipv4'                 => ':Attribute باید یک آدرس معتبر از نوع IPv4 باشد.',
    'ipv6'                 => ':Attribute باید یک آدرس معتبر از نوع IPv6 باشد.',
    'json'                 => 'فیلد :attribute باید یک رشته از نوع JSON باشد.',
    'lowercase'            => 'فیلد :attribute باید با حروف کوچک باشد.',
    'lt'                   => [
        'array'   => ':Attribute باید کمتر از :value آیتم داشته باشد.',
        'file'    => ':Attribute باید کوچکتر از :value کیلوبایت باشد.',
        'numeric' => ':Attribute باید کوچکتر از :value باشد.',
        'string'  => ':Attribute باید کمتر از :value کاراکتر داشته باشد.',
    ],
    'lte'                  => [
        'array'   => ':Attribute باید کمتر یا مساوی :value آیتم داشته باشد.',
        'file'    => ':Attribute باید کوچکتر یا مساوی :value کیلوبایت باشد.',
        'numeric' => ':Attribute باید کوچکتر یا مساوی :value باشد.',
        'string'  => ':Attribute باید کمتر یا مساوی :value کاراکتر داشته باشد.',
    ],
    'mac_address'          => ':Attribute باید یک مک آدرس صحیح باشد.',
    'max'                  => [
        'array'   => ':Attribute نباید بیشتر از :max آیتم داشته باشد.',
        'file'    => ':Attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'numeric' => ':Attribute نباید بزرگتر از :max باشد.',
        'string'  => ':Attribute نباید بیشتر از :max کاراکتر داشته باشد.',
    ],
    'max_digits'           => ':Attribute نباید بیشتر از :max رقم باشد.',
    'mimes'                => 'فرمت‌های معتبر فایل عبارتند از: :values.',
    'mimetypes'            => 'فرمت‌های معتبر فایل عبارتند از: :values.',
    'min'                  => [
        'array'   => ':Attribute نباید کمتر از :min آیتم داشته باشد.',
        'file'    => ':Attribute نباید کوچکتر از :min کیلوبایت باشد.',
        'numeric' => ':Attribute نباید کوچکتر از :min باشد.',
        'string'  => ':Attribute نباید کمتر از :min کاراکتر داشته باشد.',
    ],
    'min_digits'           => ':Attribute حداقل باید :min رقم باشد.',
    'missing'              => ':Attribute باید خالی باشد.',
    'missing_if'           => ':Attribute باید خالی باشد هنگامیکه :other برابر :value باشد.',
    'missing_unless'       => ':Attribute باید خالی باشد مگراینکه :other برابر :value باشد.',
    'missing_with'         => ':Attribute باید خالی باشد هنگامیکه :values مقدار داشته باشد.',
    'missing_with_all'     => ':Attribute باید خالی باشد هنگامیکه :values مقدار داشته باشد.',
    'multiple_of'          => 'مقدار :attribute باید مضربی از :value باشد.',
    'not_in'               => ':Attribute انتخاب شده، معتبر نیست.',
    'not_regex'            => 'فرمت :attribute معتبر نیست.',
    'numeric'              => ':Attribute باید عدد یا رشته‌ای از اعداد باشد.',
    'password'             => [
        'letters'       => ':Attribute باید حداقل شامل یک حرف باشد.',
        'mixed'         => ':Attribute باید حداقل شامل یک حرف بزرگ و یک حرف کوچک باشد.',
        'numbers'       => ':Attribute باید حداقل شامل یک عدد باشد.',
        'symbols'       => ':Attribute باید حداقل شامل یک نماد باشد.',
        'uncompromised' => ':Attribute داده شده در نشت داده ظاهر شده است. لطفاً یک :attribute متفاوت انتخاب کنید.',
    ],
    'present'              => 'فیلد :attribute باید در پارامترهای ارسالی وجود داشته باشد.',
    'prohibited'           => 'فیلد :attribute ممنوع است.',
    'prohibited_if'        => 'فیلد :attribute ممنوع است هنگامیکه مقدار :other برابر :value باشد.',
    'prohibited_unless'    => 'فیلد :attribute ممنوع است مگر اینکه مقدار :other در :values باشد.',
    'prohibits'            => 'فیلد :attribute اجازه حضور فیلد :other را نمی دهد.',
    'regex'                => 'فرمت :attribute معتبر نیست.',
    'required'             => 'فیلد :attribute الزامی است.',
    'required_array_keys'  => 'فیلد :attribute باید حاوی ورودی های :values باشد.',
    'required_if'          => 'هنگامی که :other برابر با :value است، فیلد :attribute الزامی است.',
    'required_if_accepted' => 'فیلد :attribute الزامی است هنگامیکه :other پذیرفته شده است.',
    'required_unless'      => 'فیلد :attribute الزامی است، مگر آنکه :other در :values موجود باشد.',
    'required_with'        => 'در صورت وجود فیلد :values، فیلد :attribute نیز الزامی است.',
    'required_with_all'    => 'در صورت وجود فیلدهای :values، فیلد :attribute نیز الزامی است.',
    'required_without'     => 'در صورت عدم وجود فیلد :values، فیلد :attribute الزامی است.',
    'required_without_all' => 'در صورت عدم وجود هر یک از فیلدهای :values، فیلد :attribute الزامی است.',
    'same'                 => ':Attribute و :other باید همانند هم باشند.',
    'size'                 => [
        'array'   => ':Attribute باید شامل :size آیتم باشد.',
        'file'    => ':Attribute باید برابر با :size کیلوبایت باشد.',
        'numeric' => ':Attribute باید برابر با :size باشد.',
        'string'  => ':Attribute باید برابر با :size کاراکتر باشد.',
    ],
    'starts_with'          => ':Attribute باید با یکی از این ها شروع شود: :values',
    'string'               => 'فیلد :attribute باید متن باشد.',
    'timezone'             => 'فیلد :attribute باید یک منطقه زمانی معتبر باشد.',
    'ulid'                 => ':Attribute باید یک ULID معتبر باشد.',
    'unique'               => ':Attribute قبلا انتخاب شده است.',
    'uploaded'             => 'بارگذاری فایل :attribute موفقیت آمیز نبود.',
    'uppercase'            => 'فیلد :attribute باید با حروف بزرگ باشد.',
    'url'                  => ':Attribute معتبر نمی‌باشد.',
    'uuid'                 => ':Attribute باید یک UUID معتبر باشد.',
    'attributes'           => [
        'address'                  => 'نشانی',
        'age'                      => 'سن',
        'amount'                   => 'مبلغ',
        'area'                     => 'منطقه',
        'available'                => 'موجود',
        'birthday'                 => 'تاریخ تولد',
        'body'                     => 'متن',
        'city'                     => 'شهر',
        'content'                  => 'محتوا',
        'country'                  => 'کشور',
        'created_at'               => 'ایجاد شده در',
        'creator'                  => 'سازنده',
        'current_password'         => 'رمزعبور فعلی',
        'date'                     => 'تاریخ',
        'date_of_birth'            => 'تاریخ تولد',
        'day'                      => 'روز',
        'deleted_at'               => 'حذف شده در',
        'description'              => 'توضیحات',
        'district'                 => 'ناحیه',
        'duration'                 => 'مدت',
        'email'                    => 'ایمیل',
        'excerpt'                  => 'گزیده مطلب',
        'filter'                   => 'فیلتر',
        'first_name'               => 'نام',
        'gender'                   => 'جنسیت',
        'group'                    => 'گروه',
        'hour'                     => 'ساعت',
        'image'                    => 'تصویر',
        'last_name'                => 'نام خانوادگی',
        'lesson'                   => 'درس',
        'line_address_1'           => 'آدرس 1',
        'line_address_2'           => 'آدرس 2',
        'message'                  => 'پیام',
        'middle_name'              => 'نام وسط',
        'minute'                   => 'دقیقه',
        'mobile'                   => 'شماره همراه',
        'month'                    => 'ماه',
        'name'                     => 'نام',
        'national_code'            => 'کد ملی',
        'number'                   => 'شماره',
        'password'                 => 'رمز عبور',
        'password_confirmation'    => 'تکرار رمز عبور',
        'phone'                    => 'شماره ثابت',
        'photo'                    => 'تصویر',
        'postal_code'              => 'کد پستی',
        'price'                    => 'قیمت',
        'province'                 => 'استان',
        'recaptcha_response_field' => 'فیلد جواب ریکپچا',
        'remember'                 => 'به خاطر سپردن',
        'restored_at'              => 'بازیابی شده در',
        'result_text_under_image'  => 'متن نتیجه زیر تصویر',
        'role'                     => 'نقش',
        'second'                   => 'ثانیه',
        'sex'                      => 'جنسیت',
        'short_text'               => 'متن کوتاه',
        'size'                     => 'اندازه',
        'state'                    => 'استان',
        'street'                   => 'خیابان',
        'student'                  => 'دانش آموز',
        'subject'                  => 'موضوع',
        'teacher'                  => 'معلم',
        'terms'                    => 'شرایط',
        'test_description'         => 'شرح آزمون',
        'test_locale'              => 'منطقه آزمون',
        'test_name'                => 'نام آزمون',
        'text'                     => 'متن',
        'time'                     => 'زمان',
        'title'                    => 'عنوان',
        'updated_at'               => 'بروزشده در',
        'username'                 => 'نام کاربری',
        'year'                     => 'سال',
        'length'                   => 'مدت زمان',
        'thumbnail'                => 'تصویر بندانگشتی',
        'slug'                     => 'نام یکتا',
        'url'                      => 'آدرس فایل',
        'category_id'              => 'دسته بندی',
        'file'                     => 'فایل',
        'email_type'               => 'نوع ایمیل',
        'user'                     => 'کاربر',
        'phone_number'             => 'شماره همراه',
        'g-recaptcha-response'     => 'من ربات نیستم',
        'code'                     => 'کد',
        'persian_name'             => 'نام فارسی',
    ],
];
