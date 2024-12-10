while true; do
    dig $(cat /dev/urandom | tr -dc 'a-z0-9' | fold -w 10 | head -n 1).com @$1
done
