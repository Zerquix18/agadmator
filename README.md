## Agadmator videos

<p align="center"><a href="https://travis-ci.com/Zerquix18/agadmator"><img src="https://travis-ci.com/Zerquix18/agadmator.svg?token=qGqEVpc9sLN2wwiwFiJN&branch=master" alt="Build Status"></a></p>

[Agadmator](https://www.youtube.com/agadmator) is a Youtube channel that comments chess videos. On it, you'll find a lot of chess games commented in a funny and entertaining way.

The goal of this project was to learn Vue.js by building something and this is the best idea I could get (I'm not very creative). With this, you can filter his videos, so you can:

- Get videos where X plays against Y, commented by Agadmator.
- Get all videos where X plays with the white pieces, commented by Agadmator.
- Get all videos where X plays with the Sicilian, Ruy Lopez, etc., commented by Agadmator.
- More. You can play with it!

# License

MIT.

# To Do
- Improve filters for openings
- Show the game moves.


# How to use
1. Run `php artisan migrate` to create the tables.
2. `php artisan get_videos` to get the list of videos.
3. `npm install` and `npm run dev` to build the assets.
4. Now you can play with it locally.
