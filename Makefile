# PHP
phpArtisanCMD=php artisan

phpArtisanRun=$(phpArtisanCMD)

# Composer
composerCMD=composer

composerRun=$(composerCMD)

# Make for Unix / WSL
init:
	$(composerRun) install

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
init:
	$(composerRun) install

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