# vim: set noexpandtab
all:
	./generate-doc

install:
	./install-doc
	cp -v bin/yamltools /usr/bin
