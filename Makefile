DOCKER_REGISTRY=

build:
	sed 's|%DOCKER_REGISTRY%|$(DOCKER_REGISTRY)|g' Dockerfile.nginx > Dockerfile.nginx.tmp
	sed 's|%DOCKER_REGISTRY%|$(DOCKER_REGISTRY)|g' Dockerfile.php > Dockerfile.php.tmp
	docker build \
		-f Dockerfile.nginx.tmp \
		--build-arg HTTP_PROXY=$(HTTP_PROXY) \
		-t $(DOCKER_REGISTRY)docker-library-nginx-fpm .
	docker build \
		-f Dockerfile.php.tmp \
		--build-arg HTTP_PROXY=$(HTTP_PROXY) \
		-t $(DOCKER_REGISTRY)docker-library-php-fpm .

install-gc:
	gcloud docker push $(DOCKER_REGISTRY)docker-library-nginx-fpm
	gcloud docker push $(DOCKER_REGISTRY)docker-library-php-fpm
