<?php
// Text
$_['text_title']				= 'فاتورة كلارنا - الدفع في غضون 14 يوماً';
$_['text_terms_fee']			= '<span id="klarna_invoice_toc"></span> (+%s)<script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\', charge: %s});</script>';
$_['text_terms_no_fee']			= '<span id="klarna_invoice_toc"></span><script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\'});</script>';
$_['text_additional']			= 'يتطلب حساب كلارنا بعض المعلومات الإضافية قبل أن يتمكنوا من اتمام العملية الخاصة بك.';
$_['text_male']					= 'ذكر';
$_['text_female']				= 'أنثى';
$_['text_year']					= 'سنة';
$_['text_month']				= 'شهر';
$_['text_day']					= 'يوم';
$_['text_comment']				= 'Klarna\'s Invoice ID: %s. ' . "\n" . '%s/%s: %.4f';

// Entry
$_['entry_gender']				= 'نوع الجنس';
$_['entry_pno']					= 'الرقم الشخصي';
$_['entry_dob']					= 'تاريخ الميلاد';
$_['entry_phone_no']			= 'رقم الهاتف';
$_['entry_street']				= 'الشارع';
$_['entry_house_no']			= 'رقم المنزل';
$_['entry_house_ext']			= 'تحويله البيت';
$_['entry_company']				= 'الرقم التسجيلي للشركة';

// Help
$_['help_pno']					= 'الرجاء إدخال رقم الضمان الاجتماعي الخاص بك هنا.';
$_['help_phone_no']				= 'الرجاء إدخال رقم الهاتف الخاص بك.';
$_['help_street']				= 'يرجى ملاحظة أن التسليم سوف يكون للعنوان المسجل لدى كلارنا عند الدفع عن طريقهم.';
$_['help_house_no']				= 'الرجاء إدخال رقم المنزل الخاص بك.';
$_['help_house_ext']			= 'يرجى تقديم ملحق البيت الخاص بك هنا. مثل أ، ب، ج، الأحمر، الأزرق إلخ.';
$_['help_company']				= 'الرجاء إدخال رقم التسجيل الخاص بشركتك';

// Error
$_['error_deu_terms']			= 'يجب عليك الموافقة على سياسة الخصوصية في كلارنا (Datenschutz)';
$_['error_address_match']		= 'يجب أن يتطابق عنوان الشحن و الدفع إذا كنت تريد استخدام طريقة الدفع من كلارنا';
$_['error_network']				= 'حدث خطأ أثناء الاتصال بكلارنا. الرجاء المحاولة مرة أخرى لاحقاً.';