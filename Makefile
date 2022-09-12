# PHP
phpArtisanCMD=php artisan

phpArtisanRun=$(phpArtisanCMD)

# Make for Unix / WSL
key-gen:
	$(phpArtisanRun) key:generate

run:
	$(phpArtisanRun) serve

fresh:
	$(phpArtisanRun) migrate:fresh

fresh-seed:
	$(phpArtisanRun) mirgrate:fresh -seed

clean:
	$(phpArtisanRun) route:clear

# Make for Windows
key-gen:
	$(phpArtisanRun) key:generate

run:
	$(phpArtisanRun) serve

fresh:
	$(phpArtisanRun) migrate:fresh

fresh-seed:
	$(phpArtisanRun) mirgrate:fresh -seed

clean:
	$(phpArtisanRun) route:clear