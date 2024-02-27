#!/usr/bin/python3
import sys
# get sys package for file arguments etc
import pymysql

def main():
    if len(sys.argv) != 2:
        print("Usage: Compounds_remainder_pop.py manufacturer")
        sys.exit(-1)

    try:
        # connection
        con = pymysql.connect(host='127.0.0.1', user='s2500272', passwd='SScc77**', db='s2500272_website')
        cur = con.cursor()
        manuname = sys.argv[1]
        input_name = manuname + ".elc"

        # anti injection
        sql = "SELECT id FROM Manufacturers WHERE name=%s"
        cur.execute(sql, (manuname,))
        row = cur.fetchone()

        if row is not None:
            supid = row[0]
            with open(input_name, "r") as fi:
                for line in fi:
                    elems = line.split()
                    name, natm, ncar, nnit, noxy, nsul = elems
                    # query commands
                    sql = """UPDATE Compounds 
                             SET natm=%s, ncar=%s, nnit=%s, noxy=%s, nsul=%s 
                             WHERE catn=%s AND ManuID=%s"""
                    cur.execute(sql, (natm, ncar, nnit, noxy, nsul, name, supid))

            con.commit()
        else:
            print(f"Manufacturer {manuname} not found.")
    except pymysql.Error as e:
        print(f"Database error: {e}")
    except FileNotFoundError:
        print(f"File {input_name} not found.")
    except Exception as e:
        print(f"An error occurred: {e}")
    finally:
        # close connection
        if 'con' in locals():
            con.close()

if __name__ == "__main__":
    main()

