#include<bits/stdc++.h>

using namespace std;
typedef long long ll;

#define pb push_back
#define deb(x) cout<<#x<<" : "<<x<<"\n";
#define debug(x,y) cout<<#x<<" : "<<x<<"\t"<<#y<<" : "<<y<<"\n";
#define mset(x,y) memset(x,y,sizeof(x))
#define mp(x,y) make_pair(x,y)
#define ff first
#define ss second
#define mod 1000000007
#define N 100010

ll pow_mod(ll x,ll y)
{
	ll r=1;
	for(;y;y>>=1,x=(ll)x*x%mod)
		if(y&1)r=(ll)r*x%mod;
	return r;
}

int main(){
//    ios_base::sync_with_stdio(false);cin.tie(NULL);cout.tie(NULL);
    int t;
    cin >>t;
    while (t--){
        cout << "1 31624";
        cout << flush;
        ll y;
        cin >> y;
        ll ans1 = y;
        y = 1000077376 - y;

        vector <ll> pf1;

        if(y%2==0){
            pf1.pb(2);
            while(y%2==0){
                y/=2;
            }
        }

        for(int i=3;i<=sqrt(y);i+=2){
            if(y%i==0)  pf1.pb(i);
            while(y%i==0){
                y/=i;
            }
        }

        if(y>2) pf1.pb(y);

//        for(int i=0;i<pf1.size();i++)   cout << pf1[i] << " ";
//        cout << endl;

        cout << "1 31623";
        cout << flush;
        ll yy;
        cin >> yy;
        ll ans2 = yy;
        yy = 1000014129 - yy;

        vector <ll> pf2;

        if(yy%2==0){
            pf2.pb(2);
            while(yy%2==0){
                yy/=2;
            }
        }

        for(int i=3;i<=sqrt(yy);i+=2){
            if(yy%i==0)  pf2.pb(i);
            while(yy%i==0){
                yy/=i;
            }
        }

        if(yy>2) pf2.pb(yy);

//        for(int i=0;i<pf2.size();i++)   cout << pf2[i] << " ";
//        cout << endl;

        vector <ll> nv1,nv2;
        for(int i=0;i<pf1.size();i++){
            if(pf1[i]>ans1&&pf1[i]>ans2){
                nv1.pb(pf1[i]);
            }
        }
        for(int i=0;i<pf2.size();i++){
            if(pf2[i]>ans1&&pf2[i]>ans2){
                nv2.pb(pf2[i]);
            }
        }

        int flag=0;
        for(int i=0;i<nv1.size();i++){
            for(int j=0;j<nv2.size();j++){
                if(nv1[i] == nv2[j]){
                    cout << 1 << " " << nv1[i] << "\n";
                    cout << flush ;
                    ll wq;
                    cin >> wq;
                    if(wq == 0){
                        cout << "2 " << nv1[i] << "\n";
                        cout << flush;
                        flag = 1;
                        break;
                    }
                }
            }
            if(flag)    break;
        }

        string s;
        cin >> s;

    }
    return 0;
}