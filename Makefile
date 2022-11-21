# PHP
phpArtisanCMD=php artisan

phpArtisanRun=$(phpArtisanCMD)

# Composer
composerCMD=composer

composerRun=$(composerCMD)

init:
	$(composerRun) install
	
update:
	$(composerRun) update

key-gen:
	$(phpArtisanRun) key:generate

run:
	$(phpArtisanRun) serve

fresh:
	$(phpArtisanRun) migrate:fresh

seed:
	$(phpArtisanRun) db:seed

fresh-seed:
	$(phpArtisanRun) migrate:fresh --seed

clean:
	$(phpArtisanRun) route:clear

swagger:
	$(phpArtisanRun) l5-swagger:generate
