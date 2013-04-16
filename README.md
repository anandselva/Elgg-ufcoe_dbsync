**Note!** Rename this folder to `ufcoe_dbsync` in Elgg's mod directory.

## UFCOE DB Sync

Automatically synchronizes the dataroot/wwwroot DB values to your `settings.php`, allowing you to migrate sites without manually altering DB rows.

The check is made on every request, but it's very lightweight.

### Setup

Install this plugin as `path/to/Elgg/mod/ufcoe_dbsync` and enable it.

In your `settings.php` file, you can now set these values:

```php
$CONFIG->dbsync_dataroot = '/path/to/your/data/';

$CONFIG->dbsync_wwwroot = 'http://example.org/path/to/elgg/';
```

On every request the plugin will make sure these match the DB.

**Caveat:** I've not tested this on Windows, but I do not expect problems.

*Tip:* Go ahead and set `$CONFIG->dataroot`, too. It will improve some performance in Elgg 1.9.
