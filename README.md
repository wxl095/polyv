## 保利威直播自用接口

### 直播频道创建
```php
polyv\src\channel\Create;

$di = new Create();
$di->setName($this->request->input('name'));
$di->setChannelPasswd($this->request->input('channel_password'));
$di->setAutoPlay($this->request->input('autoplay'));
$di->setMaxViewer((int)$this->request->input('max_viewer'));
$di->setScene($this->request->input('scene'));
$di->setPureRtcEnabled('Y');
$res = $di->send();
```
### 频道菜单设置
```php
use polyv\src\channel\Menu;

$menu = new Menu();
$menu->setName($this->request->input('name'));
$menu->setChannelId($this->request->input('channel_id'));
$menu->setContent($this->request->input('content'));
$menu->setType('iframe');
$ret = $menu->send();
```
### 直播频道基础设置
```php
use polyv\src\channel\BasicSettings;

$set = new BasicSettings();
$set->setChannelId('2268682');
$set->setName('基础信息修改测试');
$set->setChannelPasswd('123456789');
$set->send();
        
```
### 直播频道设置
```php
use polyv\src\channel\AuthSettings;

$auth = new AuthSettings();
$auth->setChannelId('2271659');
$auth->setRank(1);
$auth->setEnabled('Y');
$auth->setAuthType('external');
$auth->setExternalKey(env('POLYV_SECRET_KEY'));
$auth->setExternalUri('https://minisite.blue-dot.cn/api/home/liveRoom/userinfo');
$auth->send();
```