#!/bin/bash

spawn jspm registry config github
expect "yes"
send "yes"
expect "username"
send "valentinlazy"
expect "tokens"
send "51a9c2de1be5e3c1f4a0379b9ec389c2ca6ae9d9"