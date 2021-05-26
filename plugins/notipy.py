#!/usr/bin/env python3

import json
from lightning import Plugin

plugin = Plugin()
@plugin.init()

#change yourpath in this file with your path to friendlight


def init(options, configuration, plugin):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("C-lightning restarted \n")




@plugin.subscribe("connect")
def on_connect(plugin, id, address):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Connected to "+id+"\n")

@plugin.subscribe("disconnect")
def on_disconnect(plugin, id):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Disconnected from "+id+"\n")

@plugin.subscribe("channel_opened")
def on_channel_opened(plugin, channel_opened):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Channel opened with "+channel_opened["id"]+" \n")

@plugin.subscribe("channel_open_failed")
def on_channel_open_failed(plugin, channel_open_failed):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Failed to open the channel \n")

@plugin.subscribe("sendpay_success")
def on_sendpay_success(plugin, sendpay_success):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Payment success msatoshi: "+sendpay_success["msatoshi_sent"]+" \n")

@plugin.subscribe("sendpay_failure")
def on_sendpay_failure(plugin,sendpay_failure):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Payment failed\n")

@plugin.subscribe("invoice_payment")
def on_invoice_creation(plugin, invoice_payment):
    f=open("youtpath/friendlyght/clightning.log", "a+")
    f.write("Payment receive for label: "+invoice_payment["label"]+" \n")




plugin.add_option('greeting', 'Hello', 'The greeting I should use.')
plugin.run()
