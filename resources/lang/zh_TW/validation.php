<?php

/**
 * validation.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of '.config('app.name').'.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

return [
    'iban'                           => '這不是有效的 IBAN。',
    'zero_or_more'                   => '此數值不能為負數。',
    'date_or_time'                   => '此數值須為有效的日期或時間值 (ISO 8601)。',
    'source_equals_destination'      => '來源帳戶與目標帳戶相同。',
    'unique_account_number_for_user' => '此帳戶號碼似乎已在使用。',
    'unique_iban_for_user'           => '此 IBAN 似乎已在使用。',
    'deleted_user'                   => '受安全限制，您無法使用此電子郵件地址註冊。',
    'rule_trigger_value'             => '此值不適用於選取的觸發器。',
    'rule_action_value'              => '此值不適用於選取的動作。',
    'file_already_attached'          => '上傳的檔案 ":name" 已附加到該物件上。',
    'file_attached'                  => '已成功上傳檔案 ":name"。',
    'must_exist'                     => '欄位 :attribute 的 ID 不存在於資料庫。',
    'all_accounts_equal'             => '此欄位中的所有帳戶必須相等。',
    'invalid_selection'              => '您的選擇無效。',
    'belongs_user'                   => '此欄位不接受此值。',
    'at_least_one_transaction'       => '至少需要一個交易。',
    'at_least_one_repetition'        => '至少需要一次重複。',
    'require_repeat_until'           => '要嘛重複次數，要嘛結束日期 (repeat_until)，須二擇其一。',
    'require_currency_info'          => '此欄位內容須要貨幣資訊。',
    'equal_description'              => '交易描述不應等同全域描述。',
    'file_invalid_mime'              => '檔案 ":name" 類型為 ":mime"，不允許上載。',
    'file_too_large'                 => '檔案 ":name" 過大。',
    'belongs_to_user'                => ':attribute 的值未知。',
    'accepted'                       => ':attribute 必須被接受。',
    'bic'                            => '這不是有效的 BIC。',
    'at_least_one_trigger'           => '規則必須至少有一個觸發器。',
    'at_least_one_action'            => '規則必須至少有一個動作。',
    'base64'                         => '這不是有效的 base64 編碼資料。',
    'model_id_invalid'               => '指定的 ID 對於此模型似乎無效。',
    'more'                           => ':attribute 必須大於零。',
    'less'                           => ':attribute 必須小於 10,000,000。',
    'active_url'                     => ':attribute 不是有效的 URL。',
    'after'                          => ':attribute 必須是一個在 :date 之後的日期。',
    'alpha'                          => ':attribute 只能包含字母。',
    'alpha_dash'                     => ':attribute 只能包含字母、數字和破折號。',
    'alpha_num'                      => ':attribute 只能包含數字和字母。',
    'array'                          => ':attribute 必須是一個陣列。',
    'unique_for_user'                => '包括 :attribute 的紀錄已存在。',
    'before'                         => ':attribute 必須是一個在 :date 之前的日期。',
    'unique_object_for_user'         => '這個名稱已被使用。',
    'unique_account_for_user'        => '這個帳戶名稱已被使用。',
    'between.numeric'                => ':attribute 必須介於 :min 和 :max 之間。',
    'between.file'                   => ':attribute 必須介於 :min kB 到 :max kB 之間。',
    'between.string'                 => ':attribute 必須介於 :min 到 :max 個字元之間。',
    'between.array'                  => ':attribute 必須介於 :min 到 :max 個項目之間。',
    'boolean'                        => ':attribute 欄位必須為 true 或 false。',
    'confirmed'                      => ':attribute 的確認並不相符。',
    'date'                           => ':attribute 不是一個有效的日期。',
    'date_format'                    => ':attribute 不符合 :format 格式。',
    'different'                      => ':attribute 和 :other 不能相同。',
    'digits'                         => ':attribute 必須是 :digits 位數字。',
    'digits_between'                 => ':attribute 必須介於 :min 和 :max 位數字之間。',
    'email'                          => ':attribute 必須是一個有效的電子郵件地址。',
    'filled'                         => ':attribute 欄位是必填的。',
    'exists'                         => '所選的 :attribute 無效。',
    'image'                          => ':attribute 必須是圖片。',
    'in'                             => '所選的 :attribute 無效。',
    'integer'                        => ':attribute 必須是整數。',
    'ip'                             => ':attribute 必須是一個有效的 IP 位址。',
    'json'                           => ':attribute 必須是一個有效的 JSON 字串。',
    'max.numeric'                    => ':attribute 不能大於 :max。',
    'max.file'                       => ':attribute 不能大於 :max kB。',
    'max.string'                     => ':attribute 不能大於 :max 個字元。',
    'max.array'                      => ':attribute 不能多於 :max 個項目。',
    'mimes'                          => ':attribute 的檔案類型必須是 :values 。',
    'min.numeric'                    => ':attribute 至少需要 :min。',
    'lte.numeric'                    => ':attribute 必須小於或等於 :value。',
    'min.file'                       => ':attribute 必須至少為 :min kB。',
    'min.string'                     => ':attribute 最少需要有 :min 個字元。',
    'min.array'                      => ':attribute 至少需要有 :min 個項目。',
    'not_in'                         => '所選的 :attribute 無效。',
    'numeric'                        => ':attribute 必須是數字。',
    'numeric_native'                 => '本地金額必須是數字。',
    'numeric_destination'            => '目標金額必須是數字。',
    'numeric_source'                 => '來源金額必須是數字。',
    'regex'                          => ':attribute 格式無效。',
    'required'                       => ':attribute 欄位是必填的。',
    'required_if'                    => '當 :other 為 :value 時，欄位 :attribute 是必填的。',
    'required_unless'                => '除非 :other 為 :values，否則欄位 :attribute 是必填的。',
    'required_with'                  => '當 :values​​ 存在時，欄位 :attribute 是必填的。',
    'required_with_all'              => '當 :values​​ 存在時，欄位 :attribute 是必填的。',
    'required_without'               => '當 :values​​ 不存在時，欄位 :attribute 是必填的。',
    'required_without_all'           => '當沒有任何 :values​​ 存在時，欄位 :attribute 是必填的。',
    'same'                           => ':attribute 和 :other 必須相符。',
    'size.numeric'                   => ':attribute 必須是 :size。',
    'amount_min_over_max'            => '最小金額不能大於最大金額。',
    'size.file'                      => ':attribute 必須為 :size kB。',
    'size.string'                    => ':attribute 必須為 :size 個字元。',
    'size.array'                     => ':attribute 必須包含 :size 個項目。',
    'unique'                         => ':attribute 已被使用。',
    'string'                         => ':attribute 必須是字串。',
    'url'                            => ':attribute 格式無效。',
    'timezone'                       => ':attribute 必須是有效的時區。',
    '2fa_code'                       => '欄位 :attribute 無效。',
    'dimensions'                     => ':attribute 圖片尺寸無效。',
    'distinct'                       => '欄位 :attribute 有重複值。',
    'file'                           => ':attribute 必須是檔案。',
    'in_array'                       => '欄位 :attribute 不存在於 :other。',
    'present'                        => ':attribute 欄位必須存在。',
    'amount_zero'                    => '總金額不能為零。',
    'unique_piggy_bank_for_user'     => '小豬撲滿的名稱必須是獨一無二的。',
    'secure_password'                => '此密碼不安全，請再試一遍。如需更多資訊，請瀏覽 https://bit.ly/FF3-password-security',
    'valid_recurrence_rep_type'      => '定期重複交易的重複類型無效。',
    'valid_recurrence_rep_moment'    => '重複時刻在此重複類型無效。',
    'invalid_account_info'           => '無效的帳戶資訊。',
    'attributes'                     => [
        'email'                   => '電子郵件地址',
        'description'             => '描述',
        'amount'                  => '金額',
        'name'                    => '名稱',
        'piggy_bank_id'           => '小豬撲滿 ID',
        'targetamount'            => '目標金額',
        'openingBalanceDate'      => '初始餘額日期',
        'openingBalance'          => '初始餘額',
        'match'                   => '符合',
        'amount_min'              => '最小金額',
        'amount_max'              => '最大金額',
        'title'                   => '標題',
        'tag'                     => '標籤',
        'transaction_description' => '交易描述',
        'rule-action-value.1'     => '規則動作值 #1',
        'rule-action-value.2'     => '規則動作值 #2',
        'rule-action-value.3'     => '規則動作值 #3',
        'rule-action-value.4'     => '規則動作值 #4',
        'rule-action-value.5'     => '規則動作值 #5',
        'rule-action.1'           => '規則動作 #1',
        'rule-action.2'           => '規則動作 #2',
        'rule-action.3'           => '規則動作 #3',
        'rule-action.4'           => '規則動作 #4',
        'rule-action.5'           => '規則動作 #5',
        'rule-trigger-value.1'    => '規則觸發器值 #1',
        'rule-trigger-value.2'    => '規則觸發器值 #2',
        'rule-trigger-value.3'    => '規則觸發器值 #3',
        'rule-trigger-value.4'    => '規則觸發器值 #4',
        'rule-trigger-value.5'    => '規則觸發器值 #5',
        'rule-trigger.1'          => '規則觸發器 #1',
        'rule-trigger.2'          => '規則觸發器 #2',
        'rule-trigger.3'          => '規則觸發器 #3',
        'rule-trigger.4'          => '規則觸發器 #4',
        'rule-trigger.5'          => '規則觸發器 #5',
    ],
];
