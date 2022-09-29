# Fedora 37 container image using known good digest
FROM registry.fedoraproject.org/fedora@sha256:50e70b6e9baa89323352cc4caf5a072dd2f613af35390c95308a315c2075b6cf
RUN dnf install -y iproute procps iputils nmap-ncat lsof less
RUN dnf update -y 
ENTRYPOINT [ "tail", "-f", "/dev/null" ]
