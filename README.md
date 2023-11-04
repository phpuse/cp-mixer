# Mixer

Composer Plugin

- https://getcomposer.org/doc/articles/plugins.md

## 使用

在 `composer.json` 中添加

```
{
    "type": "git",
    "url": "https://github.com/phpuse/cp-mixer.git"
},

"phpuse/mixer": "dev-main",
```

## 解决问题

按照路径

## 配置

```json
{
  "extra": {
    "mixer": {
      "recurse": true,
      "replace": false,
      "ignore-duplicates": false,
      "merge-dev": true,
      "merge-extra": false,
      "merge-extra-deep": false,
      "merge-replace": true,
      "merge-scripts": false
    }
  }
}
```
