# Description
An Omeka plugin that adds a Podcast Episode item type and a valid podcast feed that conforms to the Apple and Google specifications.

# Usage
This plugin adds a new item type called Podcast Episode. To add an item to the podcast feed, make sure to use the Podcast Episode item type, include an MP3 audio file, and enter a Title and Description using Dublin Core (HTML paragraphs, links, and lists are allowed; other tags will be removed from the feed output).

After saving the plugin settings, your feed will be available at `/items/browse?output=podcast`.

# About Podcast Distribution
Once you have added some episodes, follow the usual steps to distribute your podcast. It is strongly recommended to register your podcast with both the Apple and Google podcast directories. The Apple directory is generally considered to be the most critical.

- [Apple iTunes Connect Resources and Help: Podcasts](https://itunespartner.apple.com/en/podcasts/overview)
- [Google Play Music Podcast RSS Feed Specifications](https://support.google.com/googleplay/podcasts/answer/6260341)
