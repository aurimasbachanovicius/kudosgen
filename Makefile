run:
	docker stop kudosgen; docker rm kudosgen; docker build -t kudosgen . && docker run --name kudosgen -d -p 8085:80 kudosgen:latest