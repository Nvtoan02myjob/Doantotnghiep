<?php
return [
    'required' => 'Trường :attribute là bắt buộc.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ và có đuôi .vn.',
    'regex' => 'Trường :attribute phải có dạng email hợp lệ và kết thúc bằng .vn.',
    'min' => [
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
    ],
    'max' => [
        'string' => 'Trường :attribute không được vượt quá :max ký tự.',
    ],

    'confirmed' => 'Xác nhận :attribute không khớp.',
    'attributes' => [
        'email' => 'email',
        'password' => 'mật khẩu',
        'name' => 'tên', // Nếu bạn có trường tên
        'phone' => 'số điện thoại',
    ],
];
