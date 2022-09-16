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

seeder:
	$(phpArtisanRun) db:seed

fresh-seed:
	$(phpArtisanRun) migrate:fresh -seed

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

seeder:
	$(phpArtisanRun) db:seed

fresh-seed:
	$(phpArtisanRun) migrate:fresh -seed

clean:
	$(phpArtisanRun) route:clear