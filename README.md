# Run application
```
$ make init
$ make run
```

## Test with curl
```
$ curl "http://localhost:8000/user/1?api_key=aaaaaa"
$ curl "http://localhost:8000/user/2?api_key=bbbbbb"

```

# Requirements
## Install docker 
```
$ sudo su
$ curl -sSL https://get.docker.com/ | sh
$ gpasswd -a ${USER} docker;
$ service docker restart
$ exit
```

## Install docker-compose
```
$ sudo su
$ curl -L https://github.com/docker/compose/releases/download/1.11.2/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
$ chmod +x /usr/local/bin/docker-compose
$ exit
```