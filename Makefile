up:
	docker-compose up -d
upb:
	docker-compose up -d --build
sh:
	docker-compose exec app sh
test:
	docker-compose -f docker-compose.test.yml up -d && docker logs --tail=500 forum_test
