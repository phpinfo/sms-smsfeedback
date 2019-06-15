SmsFeedback phpinfo/sms integration
===================================

Provides `SmsFeedbackSender` to integrate [SmsFeedback SDK](https://github.com/phpinfo/smsfeedback) 
with [phpinfo/sms](https://github.com/phpinfo/sms) package.

Installation
------------
```bash
composer require phpinfo/sms-smsfeedback
```

Usage
-----
```php
$sender = new SmsFeedbackSender($client);
$sender = new LoggerDecorator($sender, $logger, true);

$sender->send(new Message(79161234567, 'Some test SMS'));
```

Resources
---------

* [phpinfo/sms](https://github.com/phpinfo/sms)
* [SmsFeedback SDK](https://github.com/phpinfo/smsfeedback)
