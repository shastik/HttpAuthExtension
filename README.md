HttpAuthExtension
=================

Installation:

```
	"require": {
		"shastik/http-auth-extension": "dev-master"
	},
	"repositories": [
		{
			"type": "git",
			"url": "https://github.com/shastik/http-auth-extension.git"
		}
	],
```



Usage as simple as possible:

**config.neon:**

```
extensions:
	httpAuth: HttpAuthExtension\HttpAuthExtension

httpAuth:
	username: admin
	password: ***
	title: 'Frontend authentication' # [optional]
```
