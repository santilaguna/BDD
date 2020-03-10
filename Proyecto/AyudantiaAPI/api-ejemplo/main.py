from flask import Flask, render_template, request, abort, json, Response
from pymongo import MongoClient
from collections import defaultdict
from uuid import uuid4
import pandas as pd
import matplotlib.pyplot as plt
import os


uri = "mongodb://grupo26:grupo26@gray.ing.puc.cl/grupo26"

client = MongoClient(uri)
db = client["grupo26"]

# Iniciamos la aplicación de flask
app = Flask(__name__)


@app.route("/")
def home():
    return "<h1>Hi</h1>"

@app.route("/all")
def all_mails():
    m = db.mails.find({}, {"_id":0})
    return json.jsonify(list(m))

# @app.route("/messages/<string:id'"'_correo>")
# def get_mail_info(id_correo):

#     if id_correo is None:
#         return bad_answer("id required", 400)

#     documento_mail = db.mails.find_one({"id": id_correo}, {})
#     if documento_mail is None:
#         return bad_answer("id not found", 404)

#     return good_answer({"message": documento_mail})


@app.route("/messages/project-search")
def get_project_info():

    proyecto = request.args.get('nombre')
    if proyecto is None:
        return bad_answer("project required", 400)

    documentos_enviados = list(db.mails.find({"metadata.sender": proyecto}, {"_id": 0}))
    documentos_recibidos =list( db.mails.find({"metadata.receiver": proyecto}, {"_id": 0}))

    if not documentos_enviados and not documentos_recibidos:
        return bad_answer("project name not found", 404)

    return good_answer(
        {"sent_messages": documentos_enviados,
        "received_messages": documentos_recibidos, 
        "project_name": proyecto})


@app.route("/messages/content-search")
def get_mails_by_content():

    body = defaultdict(list)
    if request.json:
        body.update(request.json)
    else:
        all_documents = db.mails.find({}, {"_id":0})
        return good_answer({"messages": [doc for doc in all_documents]})

    desired_words = body["desired"]
    required_words = body['required']
    forbidden_words = body['forbidden']
    
    if body['required'] or body["desired"]:
        required_words = ['"' + word + '"' for word in required_words]
        forbidden_words = ["-" + word for word in forbidden_words]
        joined_words = " ".join(desired_words + required_words +  forbidden_words)

        mails = db.mails.find(
            {"$text": { "$search": joined_words}}, 
            {"_id": 0, "score": { "$meta": "textScore" }}
            ).sort([('score', {'$meta': 'textScore'})])
    else:
        all_mails = db.mails.find({}, {"_id":0})
        joined_words = " ".join([word for word in forbidden_words])
        not_mails_ids = db.mails.find({"$text": { "$search": joined_words}}, {"id": 1})
        not_ids = {doc["id"] for doc in not_mails_ids}
        mails = [message for message in all_mails if message["id"] not in not_ids]
        
    return good_answer({"messages": [doc for doc in mails]})


@app.route("/messages/<string:uid>", methods=['GET', 'DELETE'])
def show_id_mail(uid):
    if request.method == "GET":
        if uid is None:
            return bad_answer("id required", 400)

        documento_mail = db.mails.find_one({"id": uid}, {'_id':0})
        if documento_mail is None:
            return bad_answer("id not found", 404)

        return good_answer({"message": documento_mail})
    

    elif (request.method == "DELETE"):
        try:
            db.mails.remove( { "id": uid })
            return good_answer({"message": "mail deleted correctly", "id": uid})
        except:
            return bad_answer("id not found", 404)


@app.route("/messages", methods=['POST'])
def create_mail():
    keys = ["id", "content", "metadata"]
    keys_metadata = ["time", "sender", "receiver"]

    body = request.json
    if body == "":
        print("no hay body")
        return "not ok"
    print("Body:\n\n", type(body))
    uid = str(uuid4())
    existing = db.mails.find_one({"id":uid},{"_id": 0})

    while existing:
        uid = str(uuid4())
        existing = db.mails.find_one({"id":uid},{})

    for key in body:
        if key not in keys:
            return bad_answer(f"key {key} not recognized", 400)
    for key in body["metadata"]:
        if key not in keys_metadata:
            print(body)
            print(body["metadata"].keys(),"----------------------")
            return bad_answer(f"key {key} not recognized", 400)

    for key in keys:
        if "time" not in body["metadata"].keys():
            return bad_answer(f"key {key} not found", 400)

    if "time" not in body["metadata"].keys():
        return bad_answer(f"key {key} not found", 400)

    for key in ["sender", "receiver"]:
        if key not in body["metadata"].keys():
            body["metadata"][key] = None
    

    body["id"] = uid
    db.mails.insert_one(body.copy())

    return good_answer({"message": "message added correctly", "id": uid})

def bad_answer(message, status_code):
    answer = {"message": message, "status": status_code, "cat": f"https://http.cat/{status_code}"}
    return Response(json.dumps(answer), status=status_code, content_type="json")


def good_answer(answer_dict):
    answer_dict["status"] = 200
    return Response(json.dumps(answer_dict), status=200, content_type="json")


if __name__ == "__main__":
    app.run(debug = True)
'"'