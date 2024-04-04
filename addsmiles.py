#!/usr/bin/python3
import sys
# get sys package for file arguments etc
import pymysql
con = pymysql.connect(host='127.0.0.1', user='s2500272', passwd='SScc77**', db='s2500272_website')
cur = con.cursor()
if(len(sys.argv) != 2) :
  print("Usage: addsmiles.py manufacturer")
  sys.exit(-1)

manuname = sys.argv[1]
count=0
input_name = manuname+".smi"
sql = "SELECT id FROM Manufacturers WHERE name='%s'" % (manuname)
cur.execute(sql)
row = cur.fetchone()
supid = row[0]
print("The value of supid is:",supid) ;
with open(input_name,"r") as fi:
  for line in fi:
    count+=1
    print(count, end="\r", flush=True)
    elems = line.split()
    name = elems[0]
    sml = elems[1]
    sml_len=len(sml)
    sql = "Select id from Compounds where catn='%s' and ManuID='%s'" % (name,supid)
    cur.execute(sql)
    row = cur.fetchone()
    cid = row[0]
    sql = "insert into Smiles (cid,smiles) values (%s,'%s')" % (cid,sml)
    cur.execute(sql)
con.commit()
con.close()
