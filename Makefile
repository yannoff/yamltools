# vim: set noexpandtab
all:
	./generate-doc

install:
	./install-doc
	cp -v bin/yamltools /usr/bin
	cp -v bin/yaml2json /usr/bin
	cp -v bin/json2yaml /usr/bin
