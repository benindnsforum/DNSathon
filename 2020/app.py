from flask import Flask, jsonify, request
from api import *
from flask import render_template

app = Flask(__name__)


@app.route('/')

@app.route('/audit')
def index():
    return render_template('index.html', title='Home')


@app.route('/api/audit/<domain>', methods=['GET'])
def audit(domain):

    if check_if_dns_exist(domain):
        check_ns(domain)
        check_soa(domain)
        check_mx(domain)
        check_ipv6(domain)

        check_dnssec(domain)
        check_ssl(domain)

        edns_tests_full(domain)
        get_performance(domain)

        return jsonify(infos)
    else:
        return jsonify({
            'EXIST': False
        })



if __name__ == '__main__':
    app.run(debug=True, port=5555)