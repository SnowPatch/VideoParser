# VideoParser

[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg)](https://www.gnu.org/licenses/agpl-3.0)

Lightweight video parsing library. Easily get the provider, video ID or embed URL of Youtube or Vimeo videos.

<br/>

## Usage

```php
use SnowPatch\VideoParser;

// Get video provider eg. "YouTube"
$provider = VideoParser::getProvider('https://www.youtube.com/watch?v=xLs_Q4Ge7s4');

// Get video ID
$vid = VideoParser::getId('https://www.youtube.com/watch?v=xLs_Q4Ge7s4');

// Get video embed code
$embed = VideoParser::getEmbed('https://www.youtube.com/watch?v=xLs_Q4Ge7s4');
```
