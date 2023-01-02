#!/bin/bash

flyctl deploy --auto-confirm --config fly.phpfpm.toml
flyctl deploy --auto-confirm --config fly.nginx.toml
