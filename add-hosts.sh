#!/bin/bash

HOSTS_FILE=/etc/hosts
IP_ADDRESS=127.0.0.1
BACKEND=backend.local
FRONTEND=frontend.local

function addHost() {
  HOSTNAME=$1
  printf "%s\t%s\n" "$IP_ADDRESS" "$HOSTNAME" | sudo tee -a "$HOSTS_FILE" > /dev/null;
}

addHost $BACKEND
addHost $FRONTEND

