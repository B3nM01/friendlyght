#!/usr/bin/env node
const fs = require('fs');
const split = require('split');
const config = require('./config.json');
const logfile = '/tmp/clightning.log';
const logger = require('tracer').console({
    transport : (data) => {
    fs.createWriteStream(logfile, {
        flags: 'a',encoding: 'utf8',mode: 0666
    }).write(`${data.rawoutput}\n`);
}
})
let inputLine = '';
const manifestJson = {  "jsonrpc": "2.0",  "id": 1,  "result": {"options": [],"rpcmethods": [],"subscriptions": config.subscriptions, "dynamic" : true  }};
function log(severity, message) {  
    logger.info(`${severity} | ${message}`);
}
function processLine (line) { 
     inputLine += line;  try  {
         const json = JSON.parse(inputLine);inputLine = "";
         if (json["method"] == 'init') {
             process.stdout.write(JSON.parse('{}'));
             log('info', 'init call answered');
            } 
        else if (json["method"] == 'getmanifest') {
            manifestJson.id = json.id;
            process.stdout.write(JSON.stringify(manifestJson));
            log('info', JSON.stringify(manifestJson));
            
 
        } 
        else {log('info', JSON.stringify(json));}
    }
    catch(e){}}
function initPlugin() {
    log('info', 'starting plugin');
    process.stdin.pipe(split()).on('data', processLine);

};

module.exports = initPlugin();


